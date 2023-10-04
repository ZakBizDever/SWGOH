import React, { useState, useEffect } from "react";
import { Box, Flex } from "@chakra-ui/react";
import Title from "../common/title";
import Header from "../common/header";
import { useParams } from "react-router-dom";
import ApiService from "../../services/apiService";
import VaisseauProfile from "./vaisseauProfile";
import HeroVaissDetails from "../common/heroVaissDetails";

const Vaisseau = () => {
  const { id, playerCode } = useParams();
  const [vaisseauInfos, setVaisseauInfos] = useState(false);

  useEffect(() => {
    makeGetVaisseauByIdRequest({ id, ally_code: playerCode }).then((res) => {
      setVaisseauInfos(res.data);
    });
  }, []);

  useEffect(() => {}, [vaisseauInfos]);

  if (!vaisseauInfos) return null;

  return (
    <>
      <Header />
      <Title
        title={"Vaisseau"}
        backUrl={`/joueur/${playerCode}`}
        backText={"Afficher le joueur"}
      />
      <Flex>
        <Box flex={1}></Box>
        <Box flex={2} padding={10}>
          <VaisseauProfile infos={vaisseauInfos} />
        </Box>
        <Box flex={3} padding={10}>
          <HeroVaissDetails infos={vaisseauInfos} isHero={false} />
        </Box>
        <Box flex={1}></Box>
      </Flex>
    </>
  );
};

const makeGetVaisseauByIdRequest = async (payload) => {
  return await ApiService.getVaisseauById(payload);
};

export default Vaisseau;
