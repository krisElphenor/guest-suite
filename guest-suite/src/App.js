import React, { Component }  from 'react';

//Composant externe
import Chart from "react-apexcharts";
import Select from "react-dropdown-select";

//Composant local
import PlatformOverview from "./PlatformOverview";
import PlatformRanking from "./PlatformRanking";

import './App.css';

class App extends Component {
  constructor(props) {
    super(props);

    this.updateChartAndOverview = this.updateChartAndOverview.bind(this);
    this.updatePlatform = this.updatePlatform.bind(this);

    this.state = {
      avis: [],
      platforms: [],
      selected_platform: 1,
      chart_options: {
        options: {
          chart: {
            id: "chart_lines"
          },
          xaxis: {
            categories: []
          },
          dataLabels: {
            enabled: true,
          },
        },
        series: [
          {
            name: "Note du jour",
            data: [],
          }
        ]
      }
    };
  }

  componentDidMount()
  {
    fetch("http://127.0.0.1:8000/api/plateformes")
        .then( data => { return data.json() } )
        .then( data => { this.setState({platforms: data['hydra:member']}) } )
  }

  updatePlatform( platform )
  {
    this.setState(
      {
        selected_platform: typeof platform[0] != 'undefined' ? platform[0]['id'] : 0
      },
      () => this.updateChartAndOverview()
    );
  }

  updateChartAndOverview()
  {
    var axis_data = [];
    var point_data = [];

    fetch("http://127.0.0.1:8000/api/plateformes/" + this.state.selected_platform + "/avis-overview")
        .then( data => { return data.json() } )
        .then( function(data) {
            //on boucle sur les données des avis pour récupérer et formatter les infos date et note pour le graphique d'evolution
            (data['hydra:member'] || []).map(function (entry) {
                var creation_date = new Date(entry.dateDeCreation);
                axis_data.push( creation_date.getDate() + '/' + (creation_date.getMonth() + 1)   );
                point_data.push( entry.note_moyenne );
            });
            return data;
        })
        .then( (data) => { this.setState(
            prevState => (
                {
                    avis: data['hydra:member'],
                    chart_options: {
                        ...prevState.chart_options,
                        options: {
                            ...prevState.chart_options.options,
                            xaxis: {
                                categories: axis_data //liste des labels pour l'abscisse
                            }
                        },
                        series: [
                            {
                                name: "Note du jour",
                                data: point_data, //données de valeur des points (note moyenne)
                            }
                        ]
                    }
                }
            )
        )});
  }

  render()
  {
    return (
      <div className="App">
        <div className="select_wrapper">
            <Select
                labelField="nom"
                valueField="id"
                options={this.state.platforms}
                onChange={ (value) => {this.updatePlatform(value)} }
            />
        </div>

        <div className="chart_wrapper">
            <Chart
              options={this.state.chart_options.options}
              series={this.state.chart_options.series}
              type="line"
              height="300"
              width="600" />
        </div>

        <div className="platform_overview_wrapper">
          <PlatformOverview avis_overview={this.state.avis} />
        </div>

        <hr></hr>

        <div className="ranking_wrapper">
          <strong>Positionnement</strong>
          <PlatformRanking />
        </div>
      </div>
    );
  }
}

export default App;
