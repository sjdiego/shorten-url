import React, { Component } from 'react';

class ShortenResponse extends Component {
    render() {
        if (this.props.code) {
            let shortenedUrl = process.env.MIX_APP_BASEURL + '/' + this.props.code;
            return (
                <>
                    <div
                        className="bg-green-100 border-l-4 border-green-600 text-green-600 mb-12 p-4 shadow-2xl"
                        role="alert"
                    >
                        <p className="text-center">There is your shortened link</p>
                        <p className="text-2xl font-mono mt-4 break-normal"><a href={shortenedUrl} target="_blank">{shortenedUrl}</a></p>
                    </div>
                </>
            )
        }

        if (this.props.error) {
            return (
                <>
                    <div
                        className="bg-red-100 border-l-4 border-red-600 text-red-600 mb-12 p-4 shadow-2xl"
                        role="alert"
                    >
                        <p className="font-bold">We got an error</p>
                        <p className="font-mono">{this.props.error}</p>
                    </div>
                </>
            )
        }

        return null;
    }
}

export default ShortenResponse;
