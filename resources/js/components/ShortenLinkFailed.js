import React, { Component } from 'react';

class ShortenLinkFailed extends Component {
    state = {
        error: this.props.error
    }

    render() {
        return (
            <>
                <div
                    className="bg-red-100 border-l-4 border-red-600 text-red-600 mb-12 p-4 shadow-2xl"
                    role="alert"
                >
                    <p className="font-bold">We got an error</p>
                    <p className="font-mono">{this.state.error}</p>
                </div>
            </>
        )
    }
}

export default ShortenLinkFailed
