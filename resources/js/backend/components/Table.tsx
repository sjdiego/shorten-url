import React from 'react';
import TableBody from './TableBody';
import TableHeaders from './TableHeaders';

interface TableProps {
    columns: string[],
    items: object,
}

export default class Table extends React.Component<TableProps> {
    render(): React.ReactNode {
        return (
            <>
                <table className="min-w-max w-full table-auto">
                    <TableHeaders headers={this.props.columns} />
                    <TableBody columns={this.props.columns} items={this.props.items} />
                </table>    
            </>
        )
    }
}