import React from "react";
import { InputFormConfig } from "../models"

export default class InputForm extends React.PureComponent<InputFormConfig> {
    render(): React.ReactNode {
        return (
            <>
                <label
                    htmlFor={this.props.id}
                    className="block text-xs font-semibold text-gray-600 uppercase mt-4"
                >{this.props.label}</label>

                <input
                    className="block w-full py-3 px-1
                        text-gray-800 appearance-none 
                        border-b-2 border-gray-100
                        focus:text-gray-500 focus:outline-none focus:border-gray-200"
                    type={this.props.type}
                    id={this.props.id}
                    name={this.props.name}
                    placeholder={this.props.label}
                    autoComplete="no"
                    required={this.props.required}
                />
            </>
        )
    }
}
