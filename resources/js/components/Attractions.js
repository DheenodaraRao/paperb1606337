import React, { Component } from 'react'
import ReactDOM from 'react-dom'

export default class Attractions extends Component {
    constructor(props) {
        super(props)

        this.state = {
            attractions: null,
        }
    }

    componentDidMount() {
        let url = '/api/attractions'

        fetch(url, {
            headers: {
                Accept: 'application/json',
            },
            credentials: 'same-origin',
        })
        .then((response) => {
            if(!response.ok) throw Error([response.status, response.statusText].join(' '))

            return response.json()
        })
        .then((body) => {
            this.setState({
                attractions: body.data,
            })
        })
        .catch((error) => alert(error))
    }

    render() {
        const { attractions } = this.state

        let content
        {console.log(attractions)}
        if(!attractions) {
            content = (
                <p>Loading data...</p>
            )
        }
        else if(attractions.length == 0) {
            content = (
                <p>No attractions in record</p>
            )
        }
        else {
            let items = attractions.map((can) =>
                <tr key={ can.id } onClick={()=> window.location.replace("http://paperb1606337.test/attraction/" + can.id)}>
                    <td>{ can.name }</td>
                    <td>{ can.city.name }</td>
                </tr>
            )

            content = (
                <div className="table-responsive">
                    <table className="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Place Name</th>
                                <th>City Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            { items }
                        </tbody>
                    </table>
                </div>
            )
        }

        return (
            <div className="content-wrapper">
                { content }
            </div>
        )
    }
}

(() => {
    let element = document.getElementById('content-attractions')

    if(element) {
        ReactDOM.render(<Attractions />, element)
    }
})()