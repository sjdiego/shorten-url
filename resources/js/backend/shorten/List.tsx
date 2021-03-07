import React from "react";
import Table from "../components/Table";

export interface ShortenListProps {
    items: Object
}

export default class ShortenList extends React.Component<ShortenListProps> {
    render(): React.ReactNode {
        return (
            <div className="overflow-x-auto">
                <div className="min-w-screen min-h-screen flex justify-center font-sans overflow-hidden">
                    <div className="w-full lg:w-5/6">
                        <div className="bg-white shadow-md rounded my-6">
                            <Table columns={["id", "url", "slug"]} items={this.props.items} />
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}
