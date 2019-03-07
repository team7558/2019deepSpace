/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

/**
 * wrist = 0
 * elbow back = 1
 * elbow front = 2
 */

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.Subsystem;

import java.util.HashMap;
import java.util.Map;

/**
 * Add your docs here.
 */
public class Arm extends Subsystem {

  private PIDMotorJoint m_elbow, m_wrist;
  private double m_jointHeight;
  private String m_currentPreset;

  private Map<String, double[]> m_presets;

  public Arm(double jointHeight, Elbow elbow, Wrist wrist) {
    m_elbow = elbow;
    m_wrist = wrist;
    m_jointHeight = jointHeight;
    m_currentPreset = "HOLD";

    m_presets = new HashMap<String, double[]>();

    m_presets.put("HOLD", new double[] { 0, 0 });
    m_presets.put("INTAKE_CARGO", new double[] { 20, -30 });
    m_presets.put("INTAKE_HATCH_GROUND", new double[] { -35, 10 });
    m_presets.put("INTAKE_HATCH_HUMAN", new double[] { 15, 100 });
    m_presets.put("SHOOT_HATCH", new double[] { 45, 20 });
    m_presets.put("SHOOT_CARGO_ROCKET", new double[] { 90, 170 });
    m_presets.put("SHOOT_CARGO_BACK", new double[] { 90, 150 });
    m_presets.put("RELEASE_HATCH", new double[] { 15, 115 });
  }

  public void zero() {
    m_elbow.resetAngle();
    m_wrist.resetAngle();
  }

  public void updateArm() {
   /*
    System.out.println(m_jointHeight + Math.sin(toRadians(getAngles()[0])) * m_elbow.getLength()
    + Math.sin(toRadians(toRadians(getAngles()[1])) * m_wrist.getLength()));
    */
    if (m_currentPreset.equals("HOLD")) {
      hold();
    } else {
      setAngle(m_presets.get(m_currentPreset));
    }
  }

  public void changePreset(String presetName) {
    // System.out.println(presetName);
    m_currentPreset = presetName;
  }

  public boolean reachedDestination() {
    /*
     * if (m_elbow.reachedDestination() && m_wrist.reachedDestination()){
     * System.out.println("reached destination"); }
     */
    return m_elbow.reachedDestination() && m_wrist.reachedDestination();
  }

  public void setAngle(double[] targetAngles) {
    m_elbow.setAngle(targetAngles[0]);
    if (m_jointHeight + Math.sin(toRadians(getAngles()[0])) * m_elbow.getLength()
        + Math.sin(toRadians(toRadians(getAngles()[1])) * m_wrist.getLength()) > 5) {
      m_wrist.setAngle(targetAngles[1] - getAngles()[0]);
    } else {
      m_wrist.hold();
    }
  }

  public double toRadians(double angle) {
    return (Math.PI * angle) / 180;
  }

  public double[] getAngles() {
    return new double[] { m_elbow.getAngle(), m_wrist.getAngle() + m_elbow.getAngle() };
  }

  public void hold() {
    changePreset("HOLD");
    m_elbow.hold();
    m_wrist.hold();
  }

  public void enable() {
    m_elbow.enable(); 
    m_wrist.enable();
  }

  public void disable() {
    m_elbow.disable();
    m_wrist.disable();
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }
}
