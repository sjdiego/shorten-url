import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import ToggleButton from './ToggleButton';
import SubmitButton from './SubmitButton';

export default class CreateShortenForm extends React.Component {
    state = {
        url: '',
        maxHits: 0,
        expiresAt: null,
    }

    handleSetUrl = (event) => {
        this.setState({url: event.target.value})
    }
    handleSetMaxHits = (event) => {
        this.setState({maxHits: event.target.value})
    }
    handleSetExpiresAt = (event) => {
        this.setState({expiresAt: event.target.value})
    }

    handleSubmit = event => {
        event.preventDefault();

        let params = {url: this.state.url}

        if (this.state.maxHits) {
            params.maxHits = this.state.maxHits
        }

        if (this.state.expiresAt) {
            params.expiresAt = this.state.expiresAt
        }

        console.log(params)

        axios
            .post(process.env.MIX_API_BASEURL + '/shorten/create', params)
            .then(res => {
                console.log(res)
                console.log(res.data)
            })
    }


    render() {
        return (
            <div>
                <div className="flex items-center justify-center px-5 py-5" data-aos="fade-up">
                    <form onSubmit={this.handleSubmit} className="w-full mx-auto rounded-lg bg-white shadow p-5 text-gray-800 max-w-screen-sm	">
                        <div className="relative mb-2">
                            <label className="block text-xs font-semibold text-gray-500 mb-2">URL</label>
                            <input
                                placeholder="https://www.wikipedia.org"
                                autoComplete="off"
                                onChange={this.handleSetUrl}
                                required
                                className="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                            />
                        </div>

                        <div className="mb-2 flex flex-row justify-between">
                            <ToggleButton />
                            <SubmitButton />
                        </div>

                        <div className="hidden" id="shortenerOptions">
                            <hr className="my-5 border border-gray-200" />

                            <div className="mb-2">
                                <label className="block text-xs font-semibold text-gray-500 mb-2">MAX VISITS</label>
                                <input onChange={this.handleSetMaxHits} className="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="0" type="number" min="1" step="1" />
                            </div>

                            <div className="mb-2">
                                <label className="block text-xs font-semibold text-gray-500 mb-2">EXPIRE DATE</label>
                                <input onChange={this.handleSetExpiresAt} className="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="31-12-2021" type="date" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        );
    }
}

ReactDOM.render(<CreateShortenForm />, document.getElementById('create-shorten-form'));
