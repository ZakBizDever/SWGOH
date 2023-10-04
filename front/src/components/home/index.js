import React, { useState, useEffect } from "react";
import { Box, Flex, HStack, Icon } from "@chakra-ui/react";
import Header from "../common/header";
import { FaFilter } from "react-icons/fa";
import PlayersList from "./list";
import SerchField from "./searchField";
import SortField from "./sortField";
import FilterField from "./filterField";
import ApiService from "../../services/apiService";

const Home = () => {
  const [joueurs, setJoueurs] = useState([]);
  const [currentSort, setCurrentSort] = useState("pseudo");
  const [sortOrder, setSortOrder] = useState("asc");
  const [nameFilter, setNameFilter] = useState("");
  const [searchTerm, setSearchTerm] = useState("");
  const [errorSearch, setErrorSearch] = useState("");
  const [playersData, setPlayersData] = useState(joueurs);

  useEffect(() => {
    makeGetAllJoueursRequest().then((res) => {
      setJoueurs(res.data);
    });
  }, []);

  useEffect(() => {
    const sortedData = sortPlayersData(currentSort, sortOrder, nameFilter);
    setPlayersData([...sortedData]);
  }, [currentSort, sortOrder, nameFilter, joueurs]);

  const sortPlayersData = (currentSort, sortOrder, nameFilter) => {
    const filtredData = nameFilter
      ? playersData.filter((p) => p.pseudo.toLowerCase().includes(nameFilter))
      : joueurs;
    const sortedData =
      sortOrder === "asc"
        ? filtredData.sort(ascSortFn(currentSort))
        : filtredData.sort(descSortFn(currentSort));
    return sortedData;
  };

  const changeCurrentSort = (index) => {
    if (currentSort === index) {
      const newSortOrder = sortOrder === "asc" ? "desc" : "asc";
      setSortOrder(newSortOrder);
      return;
    }

    setCurrentSort(index);
    setSortOrder("asc");
  };

  const filterByName = (event) => {
    const value = event.target.value.toLowerCase();
    setNameFilter(value);
  };

  const handleChangeSearchTerm = (allyCode) => {
    setErrorSearch("");
    setSearchTerm(allyCode);
  };

  const handleSearchPlayer = async () => {
    const getPlayer = await ApiService.getJoueurByAllyCode({
      ally_code: searchTerm,
    });
    const dataPlayer = getPlayer.data;
    if (!dataPlayer)
      return setErrorSearch(`Aucun joueur avec le code : ${searchTerm}`);
    const { ally_code } = dataPlayer;
    window.location.href = `/joueur/${ally_code}`;
  };
  if (!joueurs) return null;
  return (
    <>
      <Header />
      <Flex>
        <Box flex={1}></Box>
        <Box flex={5} padding={10}>
          <Box>
            <SerchField
              searchTerm={searchTerm}
              errorSearch={errorSearch}
              handleChangeSearchTerm={handleChangeSearchTerm}
              onSearch={handleSearchPlayer}
            />
            <HStack mt={5}>
              <Icon as={FaFilter} />
              <FilterField onChangeFilter={filterByName} />
              <SortField
                name={"Nom"}
                index={"pseudo"}
                currentSort={currentSort}
                order={sortOrder}
                type={"string"}
                changeSort={changeCurrentSort}
              />
              <SortField
                name={"Puissance"}
                index={"pg_totale"}
                currentSort={currentSort}
                order={sortOrder}
                type={"number"}
                changeSort={changeCurrentSort}
              />
            </HStack>
          </Box>
          <PlayersList players={playersData} />
        </Box>
        <Box flex={1}></Box>
      </Flex>
    </>
  );
};

const makeGetAllJoueursRequest = async () => {
  return await ApiService.getAllJoueurs();
};
const ascSortFn = (index) => (a, b) => a[index] < b[index] ? -1 : 1;
const descSortFn = (index) => (a, b) => a[index] > b[index] ? -1 : 1;

export default Home;
