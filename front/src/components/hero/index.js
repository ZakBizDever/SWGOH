import React, { useEffect, useState } from "react";
import { Box, Flex } from "@chakra-ui/react";
import Title from "../common/title";
import Header from "../common/header";
import { useParams } from "react-router-dom";
import ApiService from "../../services/apiService";
import HeroProfile from "./heroProfile";
import HeroVaissDetails from "../common/heroVaissDetails";

const Hero = () => {
  const { id, playerCode } = useParams();
  const [heroInfos, setHeroInfos] = useState(false);

  useEffect(() => {
    makeGetHeroByIdRequest({ id, ally_code: playerCode }).then((res) => {
      setHeroInfos(res.data);
    });
  }, []);

  useEffect(() => {}, [heroInfos]);

  if (!heroInfos) return null;

  return (
    <>
      <Header />
      <Title
        title={"Héro"}
        backUrl={`/joueur/${playerCode}`}
        backText={"Afficher le joueur"}
      />
      <Flex>
        <Box flex={1}></Box>
        <Box flex={2} padding={10}>
          <HeroProfile infos={heroInfos} />
        </Box>
        <Box flex={3} padding={10}>
          <HeroVaissDetails infos={heroInfos} isHero={true} />
        </Box>
        <Box flex={1}></Box>
      </Flex>
    </>
  );
};

const makeGetHeroByIdRequest = async (payload) => {
  return await ApiService.getHeroById(payload);
};

export default Hero;
