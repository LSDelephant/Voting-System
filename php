
**`contracts/Voting.sol`**
```solidity
// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

contract Voting {
    struct Candidate {
        string name;
        uint256 votes;
    }

    mapping(address => bool) public hasVoted;
    Candidate[] public candidates;

    constructor(string[] memory _names) {
        for (uint i = 0; i < _names.length; i++) {
            candidates.push(Candidate({name: _names[i], votes: 0}));
        }
    }

    function vote(uint _index) public {
        require(!hasVoted[msg.sender], "Ви вже голосували");
        require(_index < candidates.length, "Неправильний кандидат");

        hasVoted[msg.sender] = true;
        candidates[_index].votes += 1;
    }

    function getCandidates() public view returns (Candidate[] memory) {
        return candidates;
    }
}
