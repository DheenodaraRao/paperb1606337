import React, { Component } from 'react'
import ReactDOM from 'react-dom'

export default class Details extends Component {
    constructor(props) {
        super(props)

        this.state = {
            attraction: null,
        }
    }

    componentDidMount() {
        var canNum = window.location.pathname.split('/')[2];
        let url = '/api/attractions/' + canNum

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
                attraction: body.data,
            })
        })
        .catch((error) => alert(error))
    }

    render() {
        const { attraction } = this.state

        let content
        {console.log(attraction)}
        if(!attraction) {
            content = (
                <p>Loading data...</p>
            )
        }
        else if(attraction.length == 0) {
            content = (
                <p>No attraction in record</p>
            )
        }
        else {
            let items = 
                <tr key={ attraction.id }>
                    <td>{ attraction.id }</td>
                    <td>{ attraction.name }</td>
                    <td>{ attraction.city.id }</td>
                    <td>{ attraction.city.name }</td>
                </tr>
            

            content = (
                <div className="table-responsive">
                    <table className="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Place Id</th>
                                <th>Place Name</th>
                                <th>City Id</th>
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
    let element = document.getElementById('content-details')

    if(element) {
        ReactDOM.render(<Details />, element)
    }
})()