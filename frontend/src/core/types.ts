export type DateType = {
    date: string,
    timezone: string,
    timezone_type: number,
}

export type CategoryType = {
    id: number,
    name: string,
}

export type MessageType = {
    id: number,
    text: string,
    delivered_at?: DateType,
    created_at: DateType,
    updated_at?: DateType,
    status: string,
    category: {
        id: number,
        name: string,
        status: string,
    }
}