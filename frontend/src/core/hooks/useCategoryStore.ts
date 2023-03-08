import {create} from "zustand";
import {CategoryType} from "@/core/types";

interface CategoryState {
    categories?: CategoryType[];
    loadCategories: () => Promise<CategoryType[]>;
}

export const useCategoryStore = create<CategoryState>((set, get) => ({
    categories: undefined,
    loadCategories: async function () {
        const cachedCategories = get().categories;

        if (cachedCategories) {
            return cachedCategories;
        }

        const response = await fetch(
            `${process.env.NEXT_PUBLIC_API_URL}/api/category`,
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

        const categories = await response.json();
        const fetchedCategories = categories._embedded.category;

        set((state) => ({
            categories: fetchedCategories,
        }));

        return fetchedCategories;
    },
}));
