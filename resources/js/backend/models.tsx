import { FormEventHandler } from "react";

export const enum InputType {
    Text = "text",
    Email = "email",
    Password = "password",
}

export interface InputFormConfig {
    label: string;
    id: string;
    name: string;
    type: InputType;
    required: boolean;
}

