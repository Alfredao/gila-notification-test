"use client";

import {Button, Card} from "react-bootstrap";
import {useEffect, useState} from "react";
import {MessageType} from "@/core/types";
import {useMessageStore} from "@/core/hooks/useMessageStore";

export default function ViewLog({params}: { params: { id: number } }) {

    const messageState = useMessageStore();
    const [message, setMessage] = useState<MessageType>()

    useEffect(() => {
        messageState.getMessage(params.id).then((p: MessageType | undefined) => setMessage(p))
    }, [params.id, messageState])

    return (
        <Card>
            <Card.Header>Logs <Button className={"float-end"} href={"/logs"} size={"sm"} variant={"secondary"}>Back</Button></Card.Header>
            <Card.Body>
                {JSON.stringify(message)}
            </Card.Body>
        </Card>
    )
}
