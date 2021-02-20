import React, { Component } from 'react';

class ShortenLinkSuccess extends Component {
    state = {
        shortenedUrl: process.env.MIX_APP_BASEURL + '/' + this.props.code
    }

    render() {
        return (
            <>
                <div
                    className="bg-green-100 border-l-4 border-green-600 text-green-600 mb-12 p-4 shadow-2xl"
                    role="alert"
                >
                    <p className="text-center">There is your shortened link</p>
                    <p className="text-2xl font-mono mt-4 break-normal"><a href={this.state.shortenedUrl} target="_blank">{this.state.shortenedUrl}</a></p>
                </div>
            </>
        )
    }
}

export default ShortenLinkSuccess
