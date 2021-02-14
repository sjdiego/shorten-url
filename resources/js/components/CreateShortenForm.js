import React from 'react';
import ReactDOM from 'react-dom';
import ToggleButton from './ToggleButton';
import SubmitButton from './SubmitButton';

function CreateShortenForm() {
    return (
        <div>
            <div className="flex items-center justify-center px-5 py-5">
                <div className="w-full mx-auto rounded-lg bg-white shadow p-5 text-gray-800 max-w-screen-sm	">
                    <div className="relative mb-2">
                        <label className="block text-xs font-semibold text-gray-500 mb-2">URL</label>
                        <input id="url" name="url" placeholder="https://www.wikipedia.org" autoComplete="off" className="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" />
                    </div>
                    
                    <div className="mb-2 flex flex-row justify-between">
                        <ToggleButton />
                        <SubmitButton />
                    </div>
                    
                    <div className="hidden" id="shortenerOptions">
                        <hr className="my-5 border border-gray-200" />
                        
                        <div className="mb-2">
                            <label className="block text-xs font-semibold text-gray-500 mb-2">MAX VISITS</label>
                            <input name="max_hits" className="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="0" type="number" min="1" step="1" />
                        </div>

                        <div className="mb-2">
                            <label className="block text-xs font-semibold text-gray-500 mb-2">EXPIRE DATE</label>
                            <input name="expires_at" className="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="31-12-2021" type="date" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default CreateShortenForm;

ReactDOM.render(<CreateShortenForm />, document.getElementById('create-shorten-form'));