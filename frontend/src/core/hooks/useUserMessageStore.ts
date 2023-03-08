import {create} from "zustand";
import {MessageType, UserMessageType} from "@/core/types";

interface UserMessageState {
    message?: UserMessageType[];
    getMessage: (id: number) => Promise<UserMessageType[] | undefined>;
}

export const useUserMessageStore = create<UserMessageState>((set, get) => ({
    message: undefined,
    getMessage: async function (id: number) {

        if (get().message) {
            return get().message;
        }

        const response = await fetch(
            `${process.env.NEXT_PUBLIC_API_URL}/api/user-message?message=${id}`,
            {
                method: "GET",
                mode: "cors",
                headers: {
                    "Content-Type": "application/json",
                },
            }
        );

        if (!response.ok) {
            throw new Error(response.statusText);
        }

        const userMessages = await response.json();
        const fetchedMessages = userMessages._embedded.user_message;

        set((state) => ({
            message: fetchedMessages,
        }));

        return fetchedMessages;
    },
}));
