import React from "react";
import SideBar from "./components/SideBar";
import ShortenList from "./shorten/List"
import {InertiaLink} from "@inertiajs/inertia-react";

export interface ShortenProps {
    shortens: Object
}

export default class Shortens extends React.Component<ShortenProps> {
    render(): React.ReactNode {
        return (
            <>
                <div className="flex h-screen bg-gray-200">
                    <SideBar />
                    <div className="flex-1 flex flex-col overflow-hidden">
                        <main className="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                            <div className="container mx-auto px-6 py-8">
                                <ShortenList items={this.props.shortens} />
                                <InertiaLink
                                    href={"/backend/shortens"}
                                    only={['shortens']}>
                                    Prev
                                </InertiaLink>
                            </div>
                        </main>
                    </div>
                </div>
            </>
        )
    }
}
