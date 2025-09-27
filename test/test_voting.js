const { expect } = require("chai");

describe("Voting", function () {
  it("коректно підраховує голоси", async function () {
    const Voting = await ethers.getContractFactory("Voting");
    const voting = await Voting.deploy(["Alice", "Bob"]);
    await voting.deployed();

    const [owner, voter] = await ethers.getSigners();

    await voting.connect(owner).vote(0);
    await voting.connect(voter).vote(1);

    const candidates = await voting.getCandidates();
    expect(candidates[0].votes).to.equal(1);
    expect(candidates[1].votes).to.equal(1);
  });
});
