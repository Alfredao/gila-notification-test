"use client";

import {Button, Card, Table} from "react-bootstrap";
import {useEffect, useState} from "react";
import {MessageType} from "@/core/types";
import {useMessageStore} from "@/core/hooks/useMessageStore";

export default function Logs() {

    const messageState = useMessageStore()
    const [messages, setMessages] = useState<MessageType[]>([]);

    useEffect(() => {
        messageState.loadMessages().then((p: MessageType[]) => setMessages(p))
    }, [])

    return (
        <Card>
            <Card.Header>Logs</Card.Header>
            <Card.Body>
                <Table striped bordered hover>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Text</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    {messages.map((message, i) => (
                        <tr key={i}>
                            <td>{message.id}</td>
                            <td>{message.category.name}</td>
                            <td>{message.text}</td>
                            <td>{message.created_at.date}</td>
                            <td>{message.status}</td>
                            <td><Button variant={"primary"} size={"sm"} href={`/logs/${message.id}`}>View</Button></td>
                        </tr>
                    ))}
                    </tbody>
                </Table>
            </Card.Body>
        </Card>
    )
}
