"use client";

import styles from './page.module.css'
import {Button, Card} from "react-bootstrap";

export default function Home() {
    return (
        <Card>
            <Card.Header>Notification System</Card.Header>
            <Card.Body>
                <Card.Title>Gila Software</Card.Title>
                <Card.Text>
                    <p>This is a notification system that receives a message and depending on the category and subscribers, sends notifications to those users in the channels they are registered.</p>
                    <p>The system does not actually send any messages or communicate with external APIs. Instead, it stores information about notifications in a log. The log includes details about the message, notification type, user data, time, and
                        more.</p>
                </Card.Text>
            </Card.Body>
        </Card>
    )
}
