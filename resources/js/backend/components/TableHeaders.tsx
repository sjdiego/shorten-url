import React from 'react';

interface TableHeadersProps {
    headers: string[],
}

export default class Table extends React.PureComponent<TableHeadersProps> {
    render() {
        return(
            <thead>
                <tr className="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    {this.props.headers.map((header, i) => {
                        return (<th className="py-3 px-6 text-left">{header}</th>)
                    })}
                    <th className="py-3 px-6 text-right">Actions</th>
                </tr>
            </thead>
        )
    }
}