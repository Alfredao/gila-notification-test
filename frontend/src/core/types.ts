export type DateType = {
    date: string,
    timezone: string,
    timezone_type: number,
}

export type CategoryType = {
    id: number,
    name: string,
    status: string,
}

export type ChannelType = {
    id: number,
    name: string,
    status: string,
}

export type UserType = {
    id: number,
    name: string,
    email: string,
}

export type MessageType = {
    id: number,
    text: string,
    delivered_at?: DateType,
    created_at: DateType,
    updated_at?: DateType,
    status: string,
    category: CategoryType
}
export type SubscriptionType = {
    id: number,
    created_at: DateType,
    updated_at?: DateType,
    category: CategoryType
    channel: ChannelType
}

export type UserMessageType = {
    id: number,
    created_at: DateType,
    updated_at?: DateType,
    user: UserType,
    message: MessageType,
    subscription: SubscriptionType,
}