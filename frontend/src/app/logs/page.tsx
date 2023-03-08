"use client";

import styles from './page.module.css'
import {Button, Card, Table} from "react-bootstrap";
import {useCategoryStore} from "@/core/hooks/useCategoryStore";
import {useEffect, useState} from "react";
import {CategoryType, MessageType} from "@/core/types";
import {useMessageState} from "@/core/hooks/useMessageStore";

export default function Logs() {

    const messageState = useMessageState()
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
                        <th>Text</th>
                    </tr>
                    </thead>
                    <tbody>
                    {messages.map((message, i) => (
                        <tr key={i}>
                            <td>{message.id}</td>
                            <td>{message.text}</td>
                        </tr>
                    ))}
                    </tbody>
                </Table>
            </Card.Body>
        </Card>
    )
}
