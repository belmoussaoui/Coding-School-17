import React from "react";
import "../node_modules/bootstrap/dist/css/bootstrap.min.css";
import "../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js";
import Header from "./components/Header/Header";
import Contenu from "./components/Section/Section";
import Footer from "./components/Footer/Footer";

class App extends React.Component {
    render() {
        return (
            <div className="app">
                <Header />
                <Contenu />
                <Footer />
            </div>
        );
    }
}

export default App;
