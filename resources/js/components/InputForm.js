import React, { Component } from 'react';

class InputForm extends Component {
    render() {
        return (
            <div className="mb-2">
                <label className="block text-xs font-semibold text-gray-500 mb-2">
                    {this.props.label}
                </label>
                <input
                    onChange={this.props.handler}
                    className="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                    placeholder={this.props.placeholder}
                    type={this.props.type}
                    required={this.props.required}
                    autoComplete={this.props.autocomplete}
                />
            </div>
        )
    }
}

export default InputForm;
