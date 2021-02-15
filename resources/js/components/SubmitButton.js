import React, { Component } from 'react';

class SubmitButton extends Component {
    cssBase = 'px-4 inline py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-blue';

    state = {
        cssEnabled: this.cssBase + ' bg-blue-600 active:bg-blue-600 hover:bg-blue-700',
        cssDisabled: this.cssBase + ' bg-blue-100 active:bg-blue-100 cursor-not-allowed'
    }

    render() {
        return (
            <button
                type="submit"
                disabled={this.props.isDisabled}
                className={this.props.isDisabled ? this.state.cssDisabled : this.state.cssEnabled}
            >
                {this.props.label}
            </button>
        )
    }
}

export default SubmitButton;
