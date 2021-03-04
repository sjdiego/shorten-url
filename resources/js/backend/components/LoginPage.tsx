import { usePage } from "@inertiajs/inertia-react";
import React from "react";
import LoginForm from "./LoginForm";

export default class LoginPage extends React.Component {
    render(): React.ReactNode {
        return (
            <div className="flex flex-col h-screen bg-gray-400">
                <div className="grid place-items-center mx-2 my-20 sm:my-auto">
                    <div className="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12 
                        px-6 py-10 sm:px-10 sm:py-6 
                        bg-white rounded-lg shadow-md lg:shadow-lg">
                            
                        <h2 className="text-center font-semibold text-3xl lg:text-4xl text-gray-800">
                            Login
                        </h2>

                        <LoginForm />
                    </div>
                </div>
            </div>
        )
    }
}
