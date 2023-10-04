import React, { useEffect, useState } from "react";
import {
  Box,
  Flex,
  TabList,
  Tab,
  TabPanels,
  TabPanel,
  Tabs,
} from "@chakra-ui/react";
import Header from "../common/header";
import { useParams } from "react-router-dom";
import ApiService from "../../services/apiService";
import Title from "../common/title";
import PlayerProfile from "./playerProfile";
import PlayerDetails from "./playerDetails";
import HerosList from "./herosList";
import VaisseauxList from "./vaisseauxList";

const Player = () => {
  const { ally_code } = useParams();
  const [playerInfos, setPlayerInfos] = useState(false);
  const [playerHeros, setPlayerHeros] = useState(false);
  const [playerVaisseaux, setPlayerVaisseaux] = useState(false);

  useEffect(() => {
    makeGetJoueurByAllyCodeRequest({ ally_code }).then((res) => {
      setPlayerInfos(res.data);
    });

    makeGetHerosByAllyCodeRequest({ ally_code }).then((res) => {
      setPlayerHeros(res.data);
    });

    makeGetVaisseauxByAllyCodeRequest({ ally_code }).then((res) => {
      setPlayerVaisseaux(res.data);
    });
  }, []);
  useEffect(() => {}, [playerInfos, playerHeros, playerVaisseaux]);

  if (!playerInfos || !playerHeros || !playerVaisseaux) return null;

  return (
    <>
      <Header />
      <Title title={"Joueur"} backUrl={`/`} backText={"Liste des joueurs"} />
      <Flex>
        <Box flex={1}></Box>
        <Box flex={2} padding={10}>
          <PlayerProfile infos={playerInfos} />
        </Box>
        <Box flex={3} padding={10}>
          <TabsInfos
            infos={playerInfos}
            playerHeros={playerHeros}
            playerVaisseaux={playerVaisseaux}
            playerCode={ally_code}
          />
        </Box>
        <Box flex={1}></Box>
      </Flex>
    </>
  );
};

const TabsInfos = ({ infos, playerHeros, playerVaisseaux, playerCode }) => {
  return (
    <Tabs>
      <TabList>
        <Tab>Infos</Tab>
        <Tab>Héros</Tab>
        <Tab>Vaisseaux</Tab>
      </TabList>
      <TabPanels>
        <TabPanel>
          <PlayerDetails infos={infos} />
        </TabPanel>
        <TabPanel>
          <HerosList heros={playerHeros} playerCode={playerCode} />
        </TabPanel>
        <TabPanel>
          <VaisseauxList vaisseaux={playerVaisseaux} playerCode={playerCode} />
        </TabPanel>
      </TabPanels>
    </Tabs>
  );
};

const makeGetJoueurByAllyCodeRequest = async (payload) => {
  return await ApiService.getJoueurByAllyCode(payload);
};

const makeGetHerosByAllyCodeRequest = async (payload) => {
  return await ApiService.getHerosByAllyCode(payload);
};

const makeGetVaisseauxByAllyCodeRequest = async (payload) => {
  return await ApiService.getVaisseauxByAllyCode(payload);
};

export default Player;
