import React from "react";

export const enum AlertType {
    Primary = "primary",
    Success = "success",
    Warning = "warning",
    Danger = "danger",
}

interface AlertProps {
    type: AlertType,
    message: Object
}

export default class AlertBox extends React.PureComponent<AlertProps, {}> {
    constructor(props: any) {
        super(props);
    }
    
    render(): React.ReactNode {
        return (
            /* TODO: set correct css class to show current color of each AlertType */
            <div className="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200 flex items-center justify-between" role="alert">
                <span>{Object.values(this.props.message)}</span>
            </div>
        )
    }
}