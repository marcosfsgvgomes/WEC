import React from "react";
import ReactDOM from "react-dom";
import SideNav, {
  Toggle,
  Nav,
  NavItem,
  NavIcon,
  NavText
} from "@trendmicro/react-sidenav";
import "@trendmicro/react-sidenav/dist/react-sidenav.css";
import "./styles.css";

function Burger() {
  return (
    <SideNav
      onSelect={selected => {
      }}
    >
      <SideNav.Toggle 
      /> 
      <SideNav.Nav eventKey="home">   
        <NavItem eventKey="home">
          <NavIcon>
          <a href="/welcome" title="Homepage"><i 
          className="fa fa-fw fa-home" style={{ fontSize: "1.75em" }} /> </a>
          </NavIcon>
          <NavText>
              <a href="/welcome">Home</a>
          </NavText>
        </NavItem>
        <SideNav.Nav defaultSelected="charts">
        <NavItem eventKey="charts">
          <NavIcon>
          <a href="/wec" title="Aplicação WEC">
            <i
              className="fa fa-fw fa-search"
              style={{ fontSize: "1.75em" }}
            /></a>
          </NavIcon>
          <NavText>
            <a href="/wec">WEC</a>
            </NavText>
          <NavItem eventKey="charts/linechart">
            <NavText>Inspecionar</NavText>
          </NavItem>
          <NavItem eventKey="charts/barchart">
            <NavText>
              <a href="/wec/show" title="Visualizar relatórios gerados">Os meus relatórios</a></NavText>
          </NavItem>
        </NavItem>
        <NavItem eventKey="tuleap">
          <NavIcon>
          <a href="https://tuleap-web.tuleap-aio-dev.docker/" title="Aplicação Tuleap">
            <i className="fa fa-fw fa-leaf" style={{ fontSize: "1.75em" }} /> </a>
          </NavIcon>
          <NavText>
              <a href="https://tuleap-web.tuleap-aio-dev.docker/">Tuleap</a>
              </NavText>
        </NavItem>
        <NavItem eventKey="setting">
          <NavIcon>
          <a href="/home" title="Definições"><i className="fa fa-fw fa-gear" style={{fontSize: "1.75em"}}
            /> </a>
          </NavIcon>                    
        <NavText>Settings</NavText>
        </NavItem>
      </SideNav.Nav>
      </SideNav.Nav>
    </SideNav>
  );
}

const rootElement = document.getElementById("burger");
ReactDOM.render(<Burger />, rootElement);