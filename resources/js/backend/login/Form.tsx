import React from "react";
import InputForm from "./InputForm";
import { LoginFormProps } from "./Page";
import { InputType } from "../InputType";
import { Inertia } from "@inertiajs/inertia"
import AlertBox, { AlertType } from "../components/AlertBox";

interface LoginFormState {
    user: string | null,
    password: string | null
}

export default class LoginForm extends React.Component<LoginFormProps, LoginFormState> {
    constructor(props: any) {
        super(props);
        this.state = {
            user: null,
            password: null
        }
        this.handleSubmit = this.handleSubmit.bind(this)
    }

    handleUserInput = (event: React.FormEvent) => {
        const element = event.currentTarget as HTMLInputElement
        this.setState({user: element.value})
    }

    handlePasswordInput = (event: React.FormEvent) => {
        const element = event.currentTarget as HTMLInputElement
        this.setState({password: element.value})
    }

    handleSubmit(event: React.FormEvent) {
        event.preventDefault();
        Inertia.post(this.props.authRoute, this.state, {preserveState: true})
    }
    
    render(): React.ReactNode {
        return (
            <form className="mt-10" onSubmit={this.handleSubmit}>
                {Object.entries(this.props.errors).length > 0 &&
                    <AlertBox type={AlertType.Danger} message={this.props.errors} />
                }

                <InputForm
                    type={InputType.Email}
                    label="E-Mail"
                    id="loginUser"
                    name="user"
                    required={true}
                    handler={this.handleUserInput}
                ></InputForm>
                
                <InputForm
                    type={InputType.Password}
                    label="Password"
                    id="loginPassword"
                    name="password"
                    required={true}
                    handler={this.handlePasswordInput}
                ></InputForm>
    
                <button
                    type="submit"
                    className="w-full py-3 mt-10 bg-gray-800 rounded-sm
                        font-medium text-white uppercase
                        focus:outline-none hover:bg-gray-700 hover:shadow-none"
                >Login</button>
            </form>
        )
    }
}