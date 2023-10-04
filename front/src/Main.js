import React from "react";
import { Routes, Route } from "react-router-dom";

import HomePage from "./pages/home";
import PlayerPage from "./pages/joueur";
import HeroPage from "./pages/hero";
import VaisseauPage from "./pages/vaisseau";

const Main = () => {
  return (
    <Routes>
      {" "}
      {/* The Routes decides which component to show based on the current URL.*/}
      <Route exact path="/" element={<HomePage />}></Route>
      <Route exact path="/joueur/:ally_code" element={<PlayerPage />}></Route>
      <Route exact path="/hero/:playerCode/:id" element={<HeroPage />}></Route>
      <Route
        exact
        path="/vaisseau/:playerCode/:id"
        element={<VaisseauPage />}
      ></Route>
    </Routes>
  );
};

export default Main;
