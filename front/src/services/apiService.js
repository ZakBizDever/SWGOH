import axios from "axios";

const _API_URL = "http://localhost:8000/api";

const getAllJoueurs = async () => {
  return await axios.get(`${_API_URL}/joueurss`);
};

const getJoueurByAllyCode = async (payload) => {
  const { ally_code } = payload;
  return await axios.get(`${_API_URL}/joueur/${ally_code}`);
};

const getHerosByAllyCode = async (payload) => {
  const { ally_code } = payload;
  return await axios.get(`${_API_URL}/joueur/${ally_code}/heros`);
};

const getVaisseauxByAllyCode = async (payload) => {
  const { ally_code } = payload;
  return await axios.get(`${_API_URL}/joueur/${ally_code}/vaisseaux`);
};

const getHeroById = async (payload) => {
  const { id, ally_code } = payload;
  return await axios.get(`${_API_URL}/joueur/${ally_code}/hero/${id}`);
};

const getVaisseauById = async (payload) => {
  const { id, ally_code } = payload;
  return await axios.get(`${_API_URL}/joueur/${ally_code}/vaisseau/${id}`);
};

const ApiService = {
  getAllJoueurs,
  getJoueurByAllyCode,
  getHerosByAllyCode,
  getVaisseauxByAllyCode,
  getHeroById,
  getVaisseauById,
};

export default ApiService;
