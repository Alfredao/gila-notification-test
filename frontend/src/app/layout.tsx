import 'bootstrap/dist/css/bootstrap.min.css';
import './globals.css'

import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import MyNavbar from "@/core/components/navbar";

export const metadata = {
    title: 'Gila Notification',
    description: 'Gila Notification Code Challenge',
}

export default function RootLayout({children}: {
    children: React.ReactNode
}) {
    return (
        <html lang="en">
        <body>
        <MyNavbar></MyNavbar>
        <main className="container pt-5 pb-5">
            {children}
        </main>
        </body>
        </html>
    )
}
