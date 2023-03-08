"use client";

import styles from './page.module.css'
import {Button, Card, Form, Spinner} from "react-bootstrap";
import {useEffect, useState} from 'react';
import {useForm} from 'react-hook-form';
import {CategoryType} from "@/core/types";
import {useCategoryStore} from "@/core/hooks/useCategoryStore";

export default function Message() {

    const {register, handleSubmit, watch, formState: {errors}} = useForm();
    const [isSubmiting, setIsSubmiting] = useState(false);
    const categoryState = useCategoryStore()

    useEffect(() => {
        categoryState.loadCategories().then(console.log)
    }, [categoryState])

    const onSubmit = async function (formData: any) {

    };

    return (
        <Card>
            <Card.Header>New message</Card.Header>
            <Card.Body>
                <Form onSubmit={handleSubmit(onSubmit)}>
                    <Form.Group className="mb-3" controlId="formBasicEmail">
                        <Form.Label>Text</Form.Label>
                        <Form.Control as={"textarea"} rows={3} placeholder="Enter your text message" {...register("text", {required: true})} />
                        {errors.text && <Form.Text className="text-danger">
                            {errors.text.message as string}
                        </Form.Text>}
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="formBasicPassword">
                        <Form.Label>Broadcast to</Form.Label>
                        <Form.Select aria-label="Default select example" {...register("category", {required: true})} >
                            {categoryState.categories && categoryState.categories.map((category, i) => (
                                <option key={i} value={category.id}>{category.name}</option>
                            ))}
                        </Form.Select>
                        {errors.category && <Form.Text className="text-danger">
                            {errors.category.message as string}
                        </Form.Text>}
                    </Form.Group>

                    <div className="col">
                        <Button variant="primary" type={"submit"} disabled={isSubmiting}>
                            {isSubmiting ? <Spinner
                                as="span"
                                animation="border"
                                size="sm"
                                role="status"
                                aria-hidden="true"
                            ></Spinner> : 'Entrar'}
                        </Button>
                    </div>
                </Form>
            </Card.Body>
        </Card>
    )
}
