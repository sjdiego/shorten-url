import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import axios from 'axios';

import InputForm from './InputForm';
import ToggleButton from './ToggleButton';
import SubmitButton from './SubmitButton';
import ShortenResponse from './ShortenResponse';
import DatePicker from "./DatePicker";

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
    handleSetExpiresAt = (dateObj, dateStr, instance) => {
        this.setState({expiresAt: dateStr})
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
            .post('/shorten/create', params, {
                baseURL: process.env.MIX_API_BASEURL,
                timeout: 3000,
                responseType: 'json',
            })
            .then(res => {
                if (res.status === 200 && res.data.code) {
                    this.setState({
                        url: null,
                        code: res.data.code,
                        error: null
                    })
                }
            })
            .catch(error => {
                if (error.response) {
                    if (error.response.data?.error) {
                        this.setState({error: error.response.data.error})
                    } else if (error.response.data?.message) {
                        this.setState({error: error.response.data.message})
                    } else if (error.response.data?.errors) {
                        let errors = [];
                        Object.values(error.response.data.errors).forEach(key => errors.push(key));
                        this.setState({error: _.join(errors, '. ')})
                    }
                } else if (error.request) {
                    this.setState({error: 'Network error'})
                } else {
                    console.log('Error', error.message)
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

                            <DatePicker
                                label={"EXPIRE DATE"}
                                handler={this.handleSetExpiresAt}
                            />
                        </div>
                    </form>
                </div>
            </>
        );
    }
}

const element = document.getElementById('create-shorten-form');

if (element) {
    ReactDOM.render(<CreateShortenForm />, element);
}
