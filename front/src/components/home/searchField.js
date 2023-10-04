import React from "react";
import {
  Box,
  InputGroup,
  Input,
  InputLeftAddon,
  HStack,
  Button,
  Text,
} from "@chakra-ui/react";
import { FaSearch } from "react-icons/fa";

const SerchField = ({
  searchTerm,
  errorSearch,
  handleChangeSearchTerm,
  onSearch,
}) => {
  const onChangeSearchTerm = (event) => {
    const allyCode = event.target.value;
    handleChangeSearchTerm(allyCode);
  };

  return (
    <Box width={400}>
      <HStack>
        <InputGroup>
          <InputLeftAddon children={<FaSearch />} />
          <Input
            value={searchTerm}
            onChange={onChangeSearchTerm}
            placeholder="Trouver un joueur par son code allié"
          />
        </InputGroup>
        <Button
          colorScheme="telegram"
          onClick={onSearch}
          isDisabled={!searchTerm}
        >
          Trouver
        </Button>
      </HStack>
      {errorSearch && <Text color={"red"}>{errorSearch}</Text>}
    </Box>
  );
};

export default SerchField;
