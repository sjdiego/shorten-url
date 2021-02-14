import React from 'react';

function SubmitButton() {
    return (
        <button
            type="submit"
            className="px-4 inline py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-blue bg-blue-600 active:bg-blue-600 hover:bg-blue-700">
            Create
        </button>
    )
}

export default SubmitButton;