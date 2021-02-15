import React, { Component } from 'react';

class ToggleButton extends Component {
    render() {
        return (
            <div className="flex flex-row items-center justify-center">
                <div
                    className="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input
                        id="toggle"
                        type="checkbox"
                        onChange={(ev) => this.props.handleShowOptions(ev.target.checked)}
                        className="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                    <label
                        htmlFor="toggle"
                        className="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"/>
                </div>
                <label htmlFor="toggle" className="text-xs text-gray-700">{this.props.label}</label>
            </div>
        )
    }
}

export default ToggleButton;
