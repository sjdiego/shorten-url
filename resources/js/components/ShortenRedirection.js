import React, { Component } from 'react'
import ReactDOM from 'react-dom';

export default class ShortenRedirection extends Component {
    state = {
        code: this.props.code,
        url: null,
        error: null,
        uuid: null,
    }

    componentDidMount() {
        axios
            .get(process.env.MIX_API_BASEURL + '/shorten/check/' + this.state.code)
            .then(res => {
                if (res.status === 200 && res.data.url) {
                    this.setState({
                        code: res.data.code,
                        url: res.data.url,
                        error: null
                    })
                }

                setTimeout((url) => {
                    window.location.href = this.state.url;
                }, 5000)
            })
            .catch(err => {
                if (err.response.data && err.response.data.error) {
                    this.setState({
                        url: null,
                        error: err.response.data.error,
                        uuid: err.response.data.uuid,
                    })
                }
            })
    }


    render() {
        if (this.state.url) {
            return (
                <>
                    <p className="text-2xl md:text-3xl font-light leading-normal animate-pulse">Please wait...</p>
                    <p className="text-lg mb-4">You are being redirected to:</p>
                    <p className="text-sm font-mono whitespace-normal break-normal md:break-all">
                        <a href={this.state.url}>{this.state.url}</a>
                    </p>
                </>
            )
        } else if (this.state.error) {
            return (
                <>
                    <p className="text-2xl md:text-3xl font-light leading-normal">Sorry!</p>
                    <p className="text-lg mb-4">The code <span className="text-red-500 font-mono border-red-400 rounded-2xl mx-2 bg-white border-2 p-1">{ this.state.code }</span> is invalid:</p>
                    <p className="text-sm font-mono whitespace-normal break-normal md:break-all">
                        {this.state.error}
                    </p>
                    <p className="mt-40 text-small text-gray-300 font-mono">{this.state.uuid}</p>
                </>
            )
        }

        return null
    }
}

const element = document.getElementById('redirection-url');

if (element) {
    ReactDOM.render(<ShortenRedirection code={element.dataset.code} />, element);
}
