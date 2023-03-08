"use client";

import {Button, Card, Table} from "react-bootstrap";
import {useEffect, useState} from "react";
import {UserMessageType} from "@/core/types";
import {useUserMessageStore} from "@/core/hooks/useUserMessageStore";

export default function ViewLog({params}: { params: { id: number } }) {

    const messageState = useUserMessageStore();
    const [userMessage, setUserMessage] = useState<UserMessageType[]>()

    useEffect(() => {
        messageState.getMessage(params.id).then((p: UserMessageType[] | undefined) => setUserMessage(p))
    }, [params.id, messageState])

    const displayMessage = userMessage && userMessage[0] ? userMessage[0] : null;

    return (
        <Card>
            <Card.Header>Logs <Button className={"float-end"} href={"/logs"} size={"sm"} variant={"secondary"}>Back</Button></Card.Header>
            <Card.Body>
                <Table bordered>
                    <tbody>
                    <tr>
                        <th>Message</th>
                        <td>{displayMessage ? displayMessage.message.text : ''}</td>
                    </tr>
                    <tr>
                        <th>Channel</th>
                        <td>{displayMessage ? displayMessage.subscription.channel.name : ''}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{displayMessage ? displayMessage.subscription.category.name : ''}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{displayMessage ? displayMessage.message.status : ''}</td>
                    </tr>
                    {displayMessage && displayMessage.message.delivered_at ? (<tr>
                        <th>Delivered at</th>
                        <td>{displayMessage.message.delivered_at.date}</td>
                    </tr>) : ''}
                    </tbody>
                </Table>
                <Table striped bordered hover>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User e-mail</th>
                        <th>Sent on</th>
                        <th>Channel</th>
                    </tr>
                    </thead>
                    <tbody>
                    {userMessage?.map((message, i) => (
                        <tr key={i}>
                            <td>{message.id}</td>
                            <td>{message.user.name}</td>
                            <td>{message.created_at.date}</td>
                            <td>{message.subscription.channel.name}</td>
                        </tr>
                    ))}
                    </tbody>
                </Table>
            </Card.Body>
        </Card>
    )
}
