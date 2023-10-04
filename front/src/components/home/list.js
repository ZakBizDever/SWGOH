import React from "react";
import {
  Box,
  Text,
  Avatar,
  CardHeader,
  Flex,
  Card,
  CardBody,
  Icon,
  Heading,
  SimpleGrid,
  Tag,
  TagLeftIcon,
  TagLabel,
  Center,
} from "@chakra-ui/react";
import { FaHandRock } from "react-icons/fa";
import { Link } from "react-router-dom";
import { formatNumber } from "../../utils/utils";

const PlayersList = ({ players }) => {
  if (!players || players.length === 0) return null;
  return (
    <SimpleGrid columns={[1, 2, 2, 3]} spacing={5} paddingY={20}>
      {players.map((p) => (
        <PlayerCard info={p} />
      ))}
    </SimpleGrid>
  );
};

const PlayerCard = ({ info }) => {
  const {
    portrait_image,
    pseudo,
    pg_totale,
    ally_code,
    titre,
    niveau,
    guilde,
  } = info;
  return (
    <Link to={`/joueur/${ally_code}`} state={{ ally_code }}>
      <Card
        maxW="md"
        variant={"elevated"}
        boxShadow={"5px 8px 27px -8px rgba(0,0,0,0.77)"}
      >
        <CardHeader pb={"10px"}>
          <Flex spacing="4">
            <Flex flex="1" gap="4" alignItems="center" flexWrap="wrap">
              <Avatar name={pseudo} src={portrait_image} />
              <Box>
                <Heading size="sm">{pseudo}</Heading>
                <Text>{titre}</Text>
              </Box>
            </Flex>
          </Flex>
        </CardHeader>
        <CardBody pt={"10px"}>
          <Box>
            <Center pb={"10px"}>
              <Tag size={"lg"} key={"size"} colorScheme="blue" alt="Puissance">
                <TagLeftIcon boxSize="12px" as={FaHandRock} />
                <TagLabel>
                  <b>{formatNumber(pg_totale)}</b>
                </TagLabel>
              </Tag>
            </Center>
            <Text>
              Code allié <b>{ally_code}</b>
            </Text>
            <Text>
              Niveau <b>{niveau}</b>
            </Text>
            <Text>
              Guilde <b>{guilde}</b>
            </Text>
          </Box>
        </CardBody>
      </Card>
    </Link>
  );
};

export default PlayersList;
