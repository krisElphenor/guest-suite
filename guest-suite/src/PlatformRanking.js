import React, { Component }  from 'react';

class PlatformRanking extends Component {
  constructor(props) {
    super(props);

    this.state = {
      ranks: []
    };
  }

  componentDidMount()
  {
    fetch("http://127.0.0.1:8000/api/plateformes/ranking")
        .then( data => { return data.json() } )
        .then( data => { this.setState({ranks: data['hydra:member']}) } )
  }

  render()
  {
    return (
      <div className="PlatformRanking">
        <ol>
          { this.state.ranks.map( function(entry, index){
            return (
                <li key={index}>
                  <strong>{entry.nom}</strong>
                  <span>{entry.note_globale}</span>
                  <em>({entry.nombre_avis} avis)</em>
                </li>
            )
          } ) }
        </ol>
      </div>
    );
  }
}

export default PlatformRanking;
