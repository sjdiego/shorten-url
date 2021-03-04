import React from "react";
import InputForm from "./InputForm";
import { InputType } from "../models"
import { Inertia} from "@inertiajs/inertia"

function handleSubmit(e: React.FormEvent) {
    e.preventDefault();
    Inertia.post("/backend/auth")
}

const LoginForm = () => (
    <form className="mt-10" method="POST" onSubmit={handleSubmit}>
        <InputForm
            type={InputType.Email}
            label="E-Mail"
            id="loginUser"
            name="user"
            required={true}
        ></InputForm>
        
        <InputForm
            type={InputType.Password}
            label="password"
            id="loginPassword"
            name="password"
            required={true}
        ></InputForm>

        <button
            type="submit"
            className="w-full py-3 mt-10 bg-gray-800 rounded-sm
                font-medium text-white uppercase
                focus:outline-none hover:bg-gray-700 hover:shadow-none"
        >Login</button>
    </form>
)

export default LoginForm