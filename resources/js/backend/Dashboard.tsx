import React from "react";
import SideBar from "./components/SideBar";
import ShortenList from "./shorten/List"

export interface DashboardProps {
    shortens: Object
}

export default class Dashboard extends React.Component<DashboardProps> {
    render(): React.ReactNode {
        return (
            <>
                <div className="flex h-screen bg-gray-200">
                    <SideBar />    
                    <div className="flex-1 flex flex-col overflow-hidden">
                        <main className="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                            <div className="container mx-auto px-6 py-8">
                                <ShortenList items={this.props.shortens} />
                            </div>
                        </main>
                    </div>
                </div>
            </>
        )
    }
}
