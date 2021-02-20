import React, { Component } from 'react';

import ShortenLinkSuccess from "./ShortenLinkSuccess";
import ShortenLinkFailed from "./ShortenLinkFailed";

class ShortenResponse extends Component {
    render() {
        if (this.props.code) {
            return <ShortenLinkSuccess code={this.props.code} />
        } else if (this.props.error) {
            return <ShortenLinkFailed error={this.props.error} />
        }
        return null
    }
}

export default ShortenResponse;
