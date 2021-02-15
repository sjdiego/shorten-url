import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import axios from 'axios';

import InputForm from './InputForm';
import ToggleButton from './ToggleButton';
import SubmitButton from './SubmitButton';
import ShortenResponse from './ShortenResponse';

export default class CreateShortenForm extends Component {
    state = {
        showOptions: false,
        submitDisabled: true,
        url: '',
        maxHits: null,
        expiresAt: null,
        code: null,
        error: null,
    }

    handleShowOptions = (event) => {
        this.setState({showOptions: event})
    }
    handleSubmitDisabled = (event) => {
        this.setState({submitDisabled: event.target.disabled})
    }
    handleSetUrl = (event) => {
        this.setState({
            url: event.target.value,
            submitDisabled: (event.target.value.length < 1)
        })
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
        this.setState({submitDisabled: true})

        if (this.state.maxHits) {
            params.maxHits = this.state.maxHits
        }
        if (this.state.expiresAt) {
            params.expiresAt = this.state.expiresAt
        }

        axios
            .post(process.env.MIX_API_BASEURL + '/shorten/create', params)
            .then(res => {
                if (res.status === 200 && res.data.code) {
                    this.setState({
                        url: null,
                        code: res.data.code,
                        error: null
                    })
                }
            })
            .catch(err => {
                if (err.response.request && err.response.request.response) {
                    this.setState({error: err.response.request.response })
                } else if (err.response.statusText) {
                    this.setState({error: err.response.statusText })
                }
                this.setState({code: null, submitDisabled: false})
            })
    }


    render() {
        return (
            <>
                <div className="flex justify-center">
                    <ShortenResponse
                        url={this.state.url}
                        code={this.state.code}
                        error={this.state.error}
                    />
                </div>
                <div className="flex items-center justify-center px-5 py-5" data-aos="fade-up">
                    <form onSubmit={this.handleSubmit} className="w-full mx-auto rounded-lg bg-white shadow p-5 text-gray-800 max-w-screen-sm	">

                        <InputForm
                            label={"URL"}
                            type={"text"}
                            placeholder={"https://www.wikipedia.org"}
                            required={true}
                            autocomplete={"off"}
                            handler={this.handleSetUrl}
                        />

                        <div className="mb-2 flex flex-row justify-between">
                            <ToggleButton
                                label={"Show options"}
                                handleShowOptions={this.handleShowOptions}
                            />
                            <SubmitButton
                                label={"Create"}
                                isDisabled={this.state.submitDisabled}
                            />
                        </div>

                        <div className={this.state.showOptions === true ? '' : 'hidden'}>
                            <hr className="my-5 border border-gray-200" />

                            <InputForm
                                type={"number"}
                                label={"MAX VISITS"}
                                placeholder={"0"}
                                handler={this.handleSetMaxHits}
                            />

                            <InputForm
                                type={"date"}
                                label={"EXPIRE DATE"}
                                placeholder={"31/12/2020"}
                                handler={this.handleSetExpiresAt}
                            />
                        </div>
                    </form>
                </div>
            </>
        );
    }
}

ReactDOM.render(<CreateShortenForm />, document.getElementById('create-shorten-form'));
