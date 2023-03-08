import {create} from "zustand";
import {MessageType} from "@/core/types";

interface MessageState {
    messages?: MessageType[];
    loadMessages: () => Promise<MessageType[]>;
}

export const useMessageState = create<MessageState>((set, get) => ({
    messages: undefined,
    loadMessages: async function () {
        const cachedCategories = get().messages;

        if (cachedCategories) {
            return cachedCategories;
        }

        const response = await fetch(
            `${process.env.NEXT_PUBLIC_API_URL}/api/message`,
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

        const messages = await response.json();
        const fetchedMessages = messages._embedded.message;

        set((state) => ({
            messages: fetchedMessages,
        }));

        return fetchedMessages;
    },
}));
