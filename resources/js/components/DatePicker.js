import React, { Component } from 'react';
import Flatpickr from 'react-flatpickr';

class DatePicker extends Component {
    constructor(props) {
        super(props);
        this.datePicker = React.createRef();
    }

    componentDidMount() {
        flatpickr(this.datePicker.current, {
            dateFormat: 'Y-m-d',
            minDate: 'today',
            onChange: this.props.handler,
            locale: {
                firstDayOfWeek: 1
            },
        })
    }

    render() {
        return (
            <div className="mb-2">
                <label className="block text-xs font-semibold text-gray-500 mb-2">
                    {this.props.label}
                </label>
                <input
                    ref={this.datePicker}
                    className="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                    placeholder="2020-12-31"
                    type="text"
                />
            </div>
        )
    }
}

export default DatePicker;
