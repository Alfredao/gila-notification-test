"use client";

import styles from './page.module.css'
import {Button, Card, Container, Nav, Navbar} from "react-bootstrap";

export default function MyNavbar() {
    return (
        <Navbar bg="dark" variant="dark">
            <Container>
                <Navbar.Brand href="/">Gila Notifications</Navbar.Brand>
                <Nav className="me-auto">
                    <Nav.Link href="/">Home</Nav.Link>
                    <Nav.Link href="/message">Message</Nav.Link>
                    <Nav.Link href="/logs">Logs</Nav.Link>
                </Nav>
            </Container>
        </Navbar>
    )
}
