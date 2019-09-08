import React, { Component }  from 'react';

import './PlatformOverview.css';

class PlatformOverview extends Component {
  render()
  {
    return (
      <div className="PlatformOverview">
        <table className="table">
          <thead>
            <tr>
              <th>Jour</th>
              <th>Nombres d'avis</th>
              <th>Note Globale</th>
            </tr>
          </thead>
          <tbody>
            { (this.props.avis_overview || []).map( function(entry, index){
                return (
                  <tr key={index}>
                    <td>{new Date(entry.dateDeCreation).toDateString()}</td>
                    <td>{entry.nombre_avis}</td>
                    <td>{entry.note_moyenne}</td>
                  </tr>
                )
            } ) }
          </tbody>
        </table>
      </div>
    );
  }
}

export default PlatformOverview;
