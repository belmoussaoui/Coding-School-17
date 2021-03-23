import React from "react";
import Article from "../Article/Article";

export default class Body extends React.Component {
    nombreArticles = 2;

    render() {
        return (
            <main>
                {this.nombreArticles >= 2 ? (
                    <>
                        <Article />
                        <Article />
                    </>
                ) : (
                    <h1>Il n'y a pas d'articles</h1>
                )}
            </main>
        );
    }
}
