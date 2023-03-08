"use client";

import {Alert, Button, Card, Form, Spinner} from "react-bootstrap";
import {useEffect, useState} from 'react';
import {useForm} from 'react-hook-form';
import {useCategoryStore} from "@/core/hooks/useCategoryStore";

export default function Message() {

    const {register, handleSubmit, reset, formState: {errors}, setError} = useForm();
    const [isSubmitting, setSubmitting] = useState(false);
    const [isSuccess, setSuccess] = useState(false);
    const categoryState = useCategoryStore()

    useEffect(() => {
        categoryState.loadCategories().then(console.log)
    }, [categoryState])

    const onSubmit = async function (formData: object) {
        setSuccess(false);
        setSubmitting(true);

        const response = await fetch(process.env.NEXT_PUBLIC_API_URL + '/api/message', {
            method: 'POST',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        });

        setSubmitting(false);

        if (!response.ok) {
            const data = await response.json();

            if (data.validation_messages) {
                Object.keys(data.validation_messages).forEach((field) => {
                    let errorMessage = Object.values(data.validation_messages[field])[0] as string;

                    setError(field, {
                        type: 'custom',
                        message: errorMessage
                    })
                });
            }

            return;
        }

        reset();

        setSuccess(true);
        setTimeout(() => setSuccess(false), 5000);
    };

    return (
        <Card>
            <Card.Header>New message</Card.Header>
            <Card.Body>
                {isSuccess ? <Alert variant={"success"}>Message sent successfully</Alert> : ''}
                <Form onSubmit={handleSubmit(onSubmit)}>
                    <Form.Group className="mb-3" controlId="formBasicMessage">
                        <Form.Label>Text</Form.Label>
                        <Form.Control as={"textarea"} rows={3} placeholder="Enter your text message" {...register("text", {required: true})} />
                        {errors.text && <Form.Text className="text-danger">
                            {errors.text.message as string}
                        </Form.Text>}
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="formBasicCategory">
                        <Form.Label>Broadcast to</Form.Label>
                        <Form.Select aria-label="Default select example" {...register("category", {required: true})} >
                            <option></option>

                            {categoryState.categories && categoryState.categories.map((category, i) => (
                                <option key={i} value={category.id}>{category.name}</option>
                            ))}
                        </Form.Select>
                        {errors.category && <Form.Text className="text-danger">
                            {errors.category.message as string}
                        </Form.Text>}
                    </Form.Group>

                    <div className="col">
                        <Button variant="primary" type={"submit"} disabled={isSubmitting}>
                            {isSubmitting ? <Spinner
                                as="span"
                                animation="border"
                                size="sm"
                                role="status"
                                aria-hidden="true"
                            ></Spinner> : 'Send message'}
                        </Button>
                    </div>
                </Form>
            </Card.Body>
        </Card>
    )
}
