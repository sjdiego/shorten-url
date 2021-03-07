import React from 'react';

interface TableHeadersProps {
    headers: string[],
}

export default class TableHeaders extends React.PureComponent<TableHeadersProps> {
    render(): React.ReactNode {
        return(
            <thead>
                <tr className="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    {this.props.headers.map((header, index) => {
                        return (<th key={index} className="py-3 px-6 text-left">{header}</th>)
                    })}
                    <th className="py-3 px-6 text-right">Actions</th>
                </tr>
            </thead>
        )
    }
}